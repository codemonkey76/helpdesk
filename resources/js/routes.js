import Dashboard from './components/views/Dashboard';
import Directory from './components/views/Directory';
import Tickets from './components/views/Tickets';
import Organizations from './components/views/Organizations';
import Companies from './components/views/Companies';
import Contacts from './components/views/Contacts';
import Jobs from './components/views/Jobs';
import Logs from './components/views/Logs';
import Users from './components/views/Users';
import Settings from './components/views/Settings';
import Bugs from './components/views/Bugs';
import Profile from "./components/views/Profile";
import Notifications from "./components/views/Notifications";
import Messages from './components/views/Messages';

export const routes = [
    {path: '/', name: 'Dashboard', component: Dashboard},
    {path: '/directory', name: 'Directory', component: Directory},
    {path: '/tickets', name: 'Tickets', component: Tickets},
    {path: '/organizations', name: 'Organizations', component: Organizations},
    {path: '/companies', name: 'Companies', component: Companies},
    {path: '/contacts', name: 'Contacts', component: Contacts},
    {path: '/jobs', name: 'Jobs', component: Jobs},
    {path: '/messages*', name: 'Messages', component: Messages},
    {path: '/logs', name: 'Logs', component: Logs},
    {path: '/users', name: 'Users', component: Users},
    {path: '/settings', name:'Settings', component: Settings},
    {path: '/bugs', name: 'Bugs', component: Bugs},
    {path: '/profile', name: 'Profile', component:Profile},
    {path: '/notifications', name: 'Notifications', component:Notifications}
];

