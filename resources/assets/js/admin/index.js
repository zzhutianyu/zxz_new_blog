import React from 'react'
import ReactDOM from 'react-dom'
import {Provider} from 'react-redux'
import store from './store'
import fetch from './utils/mixin/fetch'
import API from './api'
import './utils/style/index.scss'
import 'antd/dist/antd.css'
import {HashRouter} from 'react-router-dom'
import Routes from './router'

window.fetch = fetch
window.API = API


ReactDOM.render(
    <Provider store={store}>
        <HashRouter>
            <Routes/>
        </HashRouter>
    </Provider>
    , document.querySelector("#root"));