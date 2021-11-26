
export default {
    state: {
        userToken : null
    },
    getters: {
        isLogged(state){
            return !!state.userToken; //true or false
        }
    },
    mutations: {
        setUserToken(state,payload){
            if(payload.status == 200){
                state.userToken = payload.token;
                localStorage.setItem('userToken',JSON.stringify(payload.token));
                axios.defaults.headers.common.Authorization = `bearer ${payload.token}`
            }else{
                state.userToken = '';
                localStorage.removeItem('userToken');
            }
        },
        removeUserToken(state){
            state.userToken = null;
            localStorage.removeItem('userToken');
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
            .then(res =>{commit('setUserToken',res.data)})
            .catch(err=>{console.log(err);})
        }
    },
}