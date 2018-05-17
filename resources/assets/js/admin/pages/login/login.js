import React, { Component } from 'react'
import { Form, Icon, Input, Button } from 'antd';
import { connect } from 'react-redux'
import mapDispatchToProps from '../../reducers/auth/action'
import './login.scss'

const FormItem = Form.Item



class Login extends Component {
    constructor(props) {
        super(props)
    }

    handleSubmit = (e) =>  {
        e.preventDefault()
        this.props.form.validateFields((err, valus) => {
            if (!err) {
                this.login(valus['username'], valus['password'])
            }
        })


    }

    login = async (user, passwd) => {
        const res = await fetch(API('login'), {
            data: {
                username: user,
                password: passwd
            },
            method: 'post'
        })

        if (res.code > 0) {
            const { updateToken } = this.props;
            updateToken(res.data.token)
            this.props.history.push('/home/index')
        }


    }




    render() {
        const { getFieldDecorator } = this.props.form;

        return (
            <div className="login-wrap">
                <div className="login">
                    <Form onSubmit={this.handleSubmit} className="login-form">
                        <FormItem>
                            {getFieldDecorator('username', {
                                rules: [{ required: true, message: '请输入用户名' }],
                            })(
                                <Input prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />} placeholder="Username" />
                            )}
                        </FormItem>
                        <FormItem>
                            {getFieldDecorator('password', {
                                rules: [{ required: true, message: '请输入密码' }],
                            })(
                                <Input prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />} type="password" placeholder="Password" />
                            )}
                        </FormItem>
                        <FormItem>
                            <Button type="primary" htmlType="submit" className="login-form-button">
                                Log in
                            </Button>
                        </FormItem>
                    </Form>
                </div>
            </div>
        )
    }
}

const LoginForm = Form.create()(Login)
const LoginStore = connect(
    (state) => ({}),
    mapDispatchToProps
)(LoginForm)



export default LoginStore