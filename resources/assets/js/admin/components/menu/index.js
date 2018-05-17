import React, { Component } from 'react'
import { withRouter } from 'react-router-dom'
import { Menu } from 'antd'
import config from '../../config/menu'
import './menu.scss'

const SubMenu = Menu.SubMenu
class SideMenu extends Menu {
    constructor(props) {
        super(props)
        this.state = {
            keys: []
        }
    }

    selectKey = () => {
        const keys = [...this.props.history.location.pathname]
        this.setState({keys: keys})
    }

    componentWillMount() {
        this.selectKey()
    }

    selectHandle = ({key}) => {
        this.props.history.push(key)
    }

    componentWillReceiveProps(nextProps) {

        if (this.props.location.pathname != nextProps.location.pathname) {
            this.selectKey()
        }
    }

    render() {
        return (
            <div className="menu-wrap">
                <Menu mode="inline" theme="dark" onSelect={this.selectHandle} selectedKeys={this.state.keys}>
                    {config.map((item, index) =>
                        item.list && item.list.length > 0 ?
                            <SubMenu key={item.key} title={<span><span className={`anticon anticon-${item.icon}`}></span><span>{item.title}</span></span>}>
                                {
                                    item.list.map((listItem, listIndex) =>
                                        <Menu.Item key={item.key+listItem.key}>
                                            <span>{listItem.title}</span>
                                        </Menu.Item>
                                    )
                                }
                            </SubMenu>
                            :
                            <Menu.Item key={item.key}>
                                <span className={`anticon anticon-${item.icon}`}></span>
                                <span>{item.title}</span>
                            </Menu.Item>
                    )}
                </Menu>
            </div>
        )
    }
}
const  ExMenu = withRouter(SideMenu)

export default ExMenu