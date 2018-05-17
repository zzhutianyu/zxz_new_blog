import React, { Component } from 'react'
import { Spin } from 'antd'
import './loading.scss'
import mapDispatchToProps from '../../reducers/loading/action'
import { connect } from 'react-redux'
import { withRouter } from 'react-router-dom'

class Loading extends Component {
    constructor(props){
        super(props)
        this.state = {
            loading: false
        }
    }
    componentDidUpdate() {

        if (this.state.loading) {
            setTimeout(() => {
                this.setState({
                    loading: false
                });
            }, 500)

        }

    }


    componentWillReceiveProps() {
        this.setState({
            loading: true
        })

    }

    shouldComponentUpdate(nextProps) {
        return true
    }

    render() {

        console.log(this.state)
        return (
        <Spin tip='loading' spinning={this.state.loading}  wrapperClassName='loading-wrap' >
            {this.props.children}
        </Spin>
        )
    }

}




const StateLoding = connect(
    (state) => ({}),
    mapDispatchToProps
)(Loading)
const  ExLoading = withRouter(StateLoding)

export default ExLoading