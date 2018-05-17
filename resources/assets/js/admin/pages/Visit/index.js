import React, { Component } from 'react'
import { Table, Icon, Divider } from 'antd';
const columns = [{
    title: 'ip',
    dataIndex: 'ip',
    key: 'ip',
}, {
    title: 'country',
    dataIndex: 'country',
    key: 'country',
}, {
    title: 'province',
    dataIndex: 'province',
    key: 'province',
},  {
    title: 'city',
    dataIndex: 'city',
    key: 'city',
}];

class Visit extends Component {
    constructor(props) {
        super(props)
        this.state = {
            data: []
        }
    }

    componentWillMount() {
        this.initData()
    }

    initData = async () => {
        const data = await fetch(API('visits'), {
            method: 'get'
        })
        if (data.code > 0) {
            this.setState({data:data.data.visits})
        }
    }

    render() {



        return (
            <Table columns={columns} dataSource={this.state.data} />

        )
    }
}

export default Visit