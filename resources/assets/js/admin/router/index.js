import React from 'react'
import {Route, Switch} from 'react-router-dom'

import Login from '../pages/login'
import SideMenu from '../components/menu'
import Layout from '../components/layouts'

const Routes = () => (
    <div className="route-wrap">
        <Switch>
            <Route path="/" component={Login} exact/>
            <Route path="/home" component={Layout} />
        </Switch>
    </div>
)


export default Routes