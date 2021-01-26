export default {
    users: state => {
        return state.users.map(user => {
            return {
                id: user.id,
                label: user.first_name + ' ' + user.last_name,
                status: state.online?.some(x => x.id === user.id) ? 'on' : 'off'
            };
        });
    },
    user: state => {
        return state.user
    },
    online: state => {
        return state.online;
    },
};
