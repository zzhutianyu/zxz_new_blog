import React, { Component } from 'react'
import { Form, Icon, Input, Button , Popconfirm, Table} from 'antd';
const FormItem = Form.Item;


class EditableCell extends React.Component {
    state = {
        value: this.props.value,
        editable: false,
    }
    handleChange = (e) => {
        const value = e.target.value;
        this.setState({ value });
    }
    check = () => {
        this.setState({ editable: false });
        if (this.props.onChange) {
            this.props.onChange(this.state.value);
        }
    }
    edit = () => {
        this.setState({ editable: true });
    }
    render() {
        const { value, editable } = this.state;
        return (
            <div className="editable-cell">
                {
                    editable ?
                        <div className="editable-cell-input-wrapper">
                            <Input
                                value={value}
                                onChange={this.handleChange}
                                onPressEnter={this.check}
                            />
                            <Icon
                                type="check"
                                className="editable-cell-icon-check"
                                onClick={this.check}
                            />
                        </div>
                        :
                        <div className="editable-cell-text-wrapper">
                            {value || ' '}
                            <Icon
                                type="edit"
                                className="editable-cell-icon"
                                onClick={this.edit}
                            />
                        </div>
                }
            </div>
        );
    }
}


class Link extends Component {

    constructor(props) {
        super(props);
        this.columns = [{
            title: 'name',
            dataIndex: 'name',
            width: '30%',
            render: (text, record) => (
                <EditableCell
                    value={text}
                    onChange={this.onNameChange(record.id, 'name')}
                />
            ),
        }, {
            title: 'url',
            dataIndex: 'url',
            render: (text, record) => (
                <EditableCell
                    value={text}
                    onChange={this.onUrlChange(record.id, 'url')}
                />
            )
        }, {
            title: 'operation',
            dataIndex: 'operation',
            render: (text, record) => {
                console.log(record)
                return (
                    this.state.data.length > 0 ?
                        (
                            <Popconfirm title="Sure to delete?" onConfirm={() => this.onDelete(record.id)}>
                                <a href="javascript:;">Delete</a>
                            </Popconfirm>
                        ) : null
                );
            },
        }];

        this.state = {
            data: [],
            count: 2,
        };
    }

    componentWillMount() {
        this.initData()
    }
    onNameChange =  (id, dataIndex) => {
        return async(value) => {
            const data = [...this.state.data];
            const target = data.find(item => item.id === id);
            if (target) {
                const res = await fetch(API('link/name'), {
                    method: 'post',
                    data: {
                        id: id,
                        name: value
                    }

                })
                target[dataIndex] = value;
                this.setState({ data });
                console.log(this.state)
            }
        };
    }

    onUrlChange = (key, dataIndex) => {
        return async(value) => {
            const data = [...this.state.data]
            const target = data.find(item => item.id === id);
            if (target) {
                const res = await fetch(API('link/url'), {
                    method: 'post',
                    data: {
                        id: id,
                        url: value
                    }})
                target[dataIndex] = value;
                this.setState({
                    data
                })
            }
        }
    }

    onDelete = async (id) => {
        const res = await fetch(API('delete/link'), {
            method: 'post',
            data: {
                id: id
            }
        })
        if (res.code > 0) {
            const data = [...this.state.data];
            this.setState({ data: data.filter(item => item.id !== id) });
        }

    }

    handleAdd = async () => {
        const res = await fetch(API('get/link/id'), {
            method: 'get'
        })
        const newID = res.data.id

        const { count, data } = this.state;
        const newData = {
            id: newID,
            name: 'new name',
            url: 'new url',
        };
        this.setState({
            data: [...data, newData],
            count: count + 1,
        });
    }

    initData = async () => {
        const data = await fetch(API('get/link'), {
            method: 'get'
        })

        if (data.code > 0) {
            this.setState({
                data: data.data.link,
                count: data.data.link.length
            })
        }
    }
    render() {
        const { dataSource } = this.state;
        const columns = this.columns;
        return (
            <div>
                <Button className="editable-add-btn" onClick={this.handleAdd}>Add</Button>
                <Table bordered dataSource={this.state.data} columns={columns} />
            </div>
        );
    }
}

const WrappedHorizontalLinkForm = Form.create()(Link);

export default WrappedHorizontalLinkForm


