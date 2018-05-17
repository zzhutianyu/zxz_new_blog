import React, { Component } from 'react'
import Menu from '../menu'
import { connect } from 'react-redux'
import Loading from '../../components/loading'
import routes from "../../config/routes";
import { Route } from 'react-router-dom'
import './layout.scss'
import mapDispatchToProps from "../../reducers/auth/action";

class Layout extends Component {
    checkToken() {
        // console.log(this.props.token)
        if (!this.props.token) {
            this.props.history.push('');
        }
    }


    componentWillMount() {
    }

    componentWillReceiveProps () {
        this.checkToken()
    }



    render() {
        return (
            <div className="layout-wrap">
                <Menu/>
                <div className="layout-content">
                    <Loading>
                    {
                        routes.map((item, index) => (
                            <Route path={item.path} component={item.component} key={index} />
                        ))
                    }
                    </Loading>
                </div>
            </div>
        )
    }
}
const ExLayout = connect(
    (state) => ({
        token: state.auth.token
    }),
    {}
)(Layout)

export default ExLayout