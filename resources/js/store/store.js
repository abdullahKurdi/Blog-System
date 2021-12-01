
export default {
    state: {
        userToken : null,
        user : null,
        EditPost :{}
    },
    getters: {
        isLogged(state){
            return !!state.userToken; //true or false
        },
        isAdmin(state) {
            return state.user ? state.user.is_admin : null
        },
        PostToEdit(state){
            return state.EditPost
        }
    },
    mutations: {
        setUserToken(state,payload){
            if(payload.status == 200){
                //console.log(payload.token)
                state.userToken = payload.token;
                localStorage.setItem('userToken',JSON.stringify(payload.token));
                axios.defaults.headers.common.Authorization = `Bearer ${payload.token}`

            }else{
                state.userToken = '';
            }
        },
        userLoggedin(state,token){
                //console.log(payload.token)
                state.userToken = token;
                axios.defaults.headers.common.Authorization = `Bearer ${token}`

        },
        removeUserToken(state){
            state.userToken = null;
            localStorage.removeItem('userToken');
        },
        setUser(state, user) {
            state.user = user
        },
        logout(state){
            state.userToken = null;
            localStorage.removeItem('userToken');
            window.location.pathname="/"
        },
        EditPost(state,post){
            state.EditPost = post;
        }
    },
    actions: {
        registerUser({commit},payload){
            axios.post('/api/register',payload)
            .then(res =>{commit('setUserToken',res.data.token)})
            .catch(err=>{console.log(err);})
        },
        loginUser({commit},payload){
            axios.post('/api/login',payload)
            .then(res =>{
                console.log(res)
                commit('setUserToken',res.data)
                // axios.get('/api/user')
                // .then(res => {
                //     console.log(res.data)
                //     commit('setUser', res.data.user)
                // })
            })
            .catch(err=>{console.log(err);});

        }
    },
}
