const ListApp = {
    data() {
        return {
            arResult: window.detailMessage
        }
    },
    methods: {
        async update(data){
            axios.post('', data)
                .then(function (response) {
                    detailApp.setAxiosResult(response.data)
                })
        },
        onSubmit() {
            const data = {
                axios: 'Y',
                type: 'addComment',
                comment: this.arResult.COMMENT
            }
            this.update(data)
        },
        endMessage() {
            const data = {
                axios: 'Y',
                type: 'endMessage'
            }
            this.update(data)
        },
        setAxiosResult(result){
            this.arResult = result
        }
    }
}
const detailApp = Vue.createApp(ListApp).mount('#detailApp')