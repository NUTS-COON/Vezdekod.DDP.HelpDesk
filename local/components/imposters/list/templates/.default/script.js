const ListApp = {
    data() {
        return {
            arResult: window.listMessage
        }
    },
    methods: {
        async reload(){
            const url = this.getRequestUrl()
            const urlAxios = url + '&axios=Y'
            axios.get(urlAxios)
            .then(function (response) {
                listApp.setAxiosResult(url, response.data)
            })
        },
        getRequestUrl(){
            let url = '?'
            if(this.arResult.PARAMS.page != 1){
                url = url + 'page=' + this.arResult.PARAMS.page + '&'
            }
            if(this.arResult.PARAMS.sumPage != 10){
                url = url + 'sumPage=' + this.arResult.PARAMS.sumPage + '&'
            }
            if(this.arResult.PARAMS.status){
                url = url + 'status=' + this.arResult.PARAMS.status + '&'
            }
            if(this.arResult.PARAMS.id){
                url = url + 'id=' + this.arResult.PARAMS.id + '&'
            }
            if(url.substr(-1) == '&')
                return url.substring(0, url.length - 1)
            return url
        },
        inputID(){
            this.arResult.PARAMS.id = this.arResult.PARAMS.id.replace(  /\D/g, '')
        },
        setAxiosResult(url, result){
            this.arResult = result
            const newUrl = (url.length == 1) ? window.location.pathname : window.location.pathname + url
            history.pushState(result, '', newUrl);
        }
    }
}
const listApp = Vue.createApp(ListApp).mount('#listApp')