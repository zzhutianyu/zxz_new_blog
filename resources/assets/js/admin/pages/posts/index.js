import React, { Component } from 'react'
import { Button,  Icon,List, Avatar, Spin, Popconfirm } from 'antd';
import { connect } from 'react-redux'
import {withRouter} from "react-router-dom";
import './posts.scss'

const listData = [];
for (let i = 0; i < 23; i++) {
    listData.push({
        href: 'http://ant.design',
        title: `ant design part ${i}`,
        avatar: 'https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png',
        description: 'Ant Design, a design language for background applications, is refined by Ant UED Team.',
        content: 'We supply a series of design principles, practical patterns and high quality design resources (Sketch and Axure), to help people create their product prototypes beautifully and efficiently.',
    });
}

const IconText = ({ type, text }) => (
    <span>
    <Icon type={type} style={{ marginRight: 8 }} />
        {text}
  </span>
);
class Posts extends Component {
    constructor(props) {
        super(props)
        this.state = {
            data: [],
            page: 0,
            size: 0,
            nextPage: '',
            lastPage: '',
            path: ''
        }


    }

    componentWillMount() {
        this.initData()
    }



    initData = async (page = 0) => {
        const data = await fetch(API('posts'), {
            method: 'get',
            params: {
                page: page
            }

        })

        if (data.code > 0) {
            const posts = data.data.posts
            this.setState({
                data: posts.data,
                page: posts.current_page,
                size: posts.total,
                lastPage: posts.last_page_url,
                nextPage: posts.next_page_url,
                path: posts.path
            })

            console.log(this.state)
            return
        }
    }

    intoPostEdit(id) {
        console.log(id);
        this.props.history.push({
            pathname: '/home/edit',
            state: {
                id: id
            }
        })
    }

    intoEdit() {
        this.props.history.push('/home/edit')
    }




    render() {
        const changeData = this.initData
        return (
            <div className="posts-wrap">
                <div className="posts-head">
                    <Button type="primary" onClick={this.intoEdit.bind(this)}>add</Button>
                </div>

                <div className="posts-content">
                    <List
                        itemLayout="vertical"
                        size="large"
                        pagination={{
                            onChange: (page) => {
                                changeData(page)
                            },
                            pageSize: 5,
                            total: this.state.size,
                            current: this.state.page,
                        }}
                        dataSource={this.state.data}
                        footer={<div><b>ant design</b> footer part</div>}
                        renderItem={item => (
                            <List.Item
                                key={item.id}
                                actions={[<IconText type="star-o" text={item.view} />, <IconText type="like-o" text={item.like} />,                             <Popconfirm title="Sure to delete?" onConfirm={() => this.onDelete(record.id)}>
                                    <a href="javascript:;">Delete</a>
                                </Popconfirm>]}
                                    extra={<img width={272} alt="logo" src={item.image} />}

                            >
                                <List.Item.Meta
                                    avatar={<Avatar href={item.image} />}
                                    title={<a onClick={this.intoPostEdit.bind(this, item.id)}>{item.title}</a>}
                                />
                                {item.content}
                            </List.Item>
                        )}
                    />

                </div>
            </div>

        )
    }
}


export default withRouter(Posts)



