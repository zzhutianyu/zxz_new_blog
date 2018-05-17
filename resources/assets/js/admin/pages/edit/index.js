import React, {Component} from 'react'
import {
    Form,
    Input,
    Tooltip,
    Icon,
    Cascader,
    Select,
    Row,
    Col,
    Checkbox,
    Button,
    AutoComplete,
    Upload,
    Tag
} from 'antd';
import mapDispatchToProps from "../../reducers/auth/action";
import {connect} from 'react-redux'

const FormItem = Form.Item;
const {TextArea} = Input;

class Edit extends Component {
    constructor(props) {
        super(props)
    }

    state = {
        tags: [],
        inputVisible: false,
        inputValue: '',
        imgId: 0,
        musicId: 0,
        content: '',
        title: '',
        postId: 0,

    };

    componentWillMount() {
        if (!!this.props.location.state) {
            this.initData()
            return
        }
    }


    initData = async () => {
        const data = await fetch(API('get/post'), {
            method: 'get',
            params: {
                id: this.props.location.state.id
            }
        })

        if (data.code > 0) {
            this.setState({
                title: data.data.post.title,
                content: data.data.post.raw_content,
                postId: data.data.post.id
            })
            return
        }

    }


    handleClose = (removedTag) => {
        const tags = this.state.tags.filter(tag => tag !== removedTag);
        console.log(tags);
        this.setState({tags});
    }

    showInput = () => {
        this.setState({inputVisible: true}, () => this.input.focus());
    }

    handleInputChange = (e) => {
        this.setState({inputValue: e.target.value});
    }

    handleInputConfirm = () => {
        const state = this.state;
        const inputValue = state.inputValue;
        let tags = state.tags;
        if (inputValue && tags.indexOf(inputValue) === -1) {
            tags = [...tags, inputValue];
        }
        console.log(tags);
        this.setState({
            tags,
            inputVisible: false,
            inputValue: '',
        });
    }

    saveInputRef = input => this.input = input


    handleContentChange = (e) => {
        this.setState({
            content: e.target.value
        })

        console.log(this.state)
    }

    handleTitleChange = (e) => {
        this.setState({
            title: e.target.value
        })
    }

    handleSub = (e) => {
        if (!!this.props.location.state) {
            this.save()
            return
        }
        this.create()

    }


    save = async () => {
        const params = {
            id: this.state.postId,
            title: this.state.title,
            content: this.state.content
        }

        const res = fetch(API('upload/post/edit'), {
            method: 'post',
            data: params
        })

        if (res.code > 0) {
            this.histroy.push('');
        }
    }

    create = async () => {
        const state = this.state
        const params = {
            title: state.title,
            content: state.content,
            tags: state.tags,
            imageId: state.imgId,
            musicId: state.musicId
        }

        const res = await fetch(API('upload/post'), {
            method: 'post',
            data: params
        })

        if (res.code > 0) {
            this.props.history.push('/home/posts');
        }

    }



    render() {
        const {getFieldDecorator} = this.props.form;
        const formItemLayout = {};
        const {tags, inputVisible, inputValue} = this.state;
        const propsImg = {
            name: 'file',
            action: API('upload/image'),
            headers: {
                authorization: `Bearer ${this.props.token}`,
            },
            onChange: (info) => {
                if (info.file.status === 'done') {
                    const data = info.file.response
                    console.log(data)

                    if (data.code > 0) {
                        this.setState({
                            imgId: data.data.imageId
                        })
                        console.log(this.state)
                    }
                }

            },
        };

        const propsMusic = {
            name: 'file',
            action: API('upload/music'),
            headers: {
                authorization: `Bearer ${this.props.token}`,
            },
            onChange:(info) => {
                console.log(info)
                if (info.file.status == 'done') {
                    const data = info.file.response
                    console.log(data)

                    if (data.code > 0) {
                        this.setState({
                            musicId: data.data.musicId
                        })
                        console.log(this.state)
                    }
                }


            },
        }
        return (
            <div className="edit-wrap">
                <Form onSubmit={this.handleSubmit}>
                    <FormItem
                        {...formItemLayout}
                        label="title"
                    >

                            <Input onChange={this.handleTitleChange} value={this.state.title}/>

                    </FormItem>
                    <FormItem>
                        <Upload {...propsImg}>
                            <Button>
                                <Icon type="upload"/> 选择图片
                            </Button>
                        </Upload>
                    </FormItem>
                    <FormItem>
                        <Upload {...propsMusic}>
                            <Button>
                                <Icon type="upload"/> 选择音乐
                            </Button>
                        </Upload>
                    </FormItem>
                    <FormItem>
                        <div>
                            {tags.map((tag, index) => {
                                const isLongTag = tag.length > 20;
                                const tagElem = (
                                    <Tag key={tag} closable={true} afterClose={() => this.handleClose(tag)}>
                                        {isLongTag ? `${tag.slice(0, 20)}...` : tag}
                                    </Tag>
                                );
                                return isLongTag ? <Tooltip title={tag} key={tag}>{tagElem}</Tooltip> : tagElem;
                            })}
                            {inputVisible && (
                                <Input
                                    ref={this.saveInputRef}
                                    type="text"
                                    size="small"
                                    style={{width: 78}}
                                    value={inputValue}
                                    onChange={this.handleInputChange}
                                    onBlur={this.handleInputConfirm}
                                    onPressEnter={this.handleInputConfirm}
                                />
                            )}
                            {!inputVisible && (
                                <Tag
                                    onClick={this.showInput}
                                    style={{background: '#fff', borderStyle: 'dashed'}}
                                >
                                    <Icon type="plus"/> New Tag
                                </Tag>
                            )}
                        </div>
                    </FormItem>

                    <FormItem>
                        <TextArea rows={6} onChange={this.handleContentChange} value={this.state.content}/>
                    </FormItem>
                    <FormItem>
                        <Button type="primary" htmlType="submit" onClick={this.handleSub} >
                            确定保存
                        </Button>
                    </FormItem>

                </Form>

            </div>
        )
    }

}


const wrapEdit = Form.create()(Edit)
const PropEdit = connect(
    (state) => ({
        token: state.auth.token
    }),
    {}
)(wrapEdit)

export default PropEdit