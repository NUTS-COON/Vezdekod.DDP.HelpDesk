const FormaApp = {
    data() {
        return {
            fio: '',
            phone: '',
            text: '',
            id: null,
            errors: {
                fio: false,
                phone: false,
                text: false,
                server: false
            }
        }
    },
    methods: {
        async onSubmit() {
            if(this.validate()){
                axios.post('', {
                    type: 'resultForm',
                    fio: this.fio,
                    phone: this.phone,
                    text: this.text
                })
                .then(function (response) {
                    app.setServerError(false)
                    app.setId(response.data)
                })
                .catch(function () {
                    app.setServerError()
                })
            }
        },
        phoneInput(e){
            this.phone = this.phone.replace( /(?!\d|\(|\)|\+|-|\s)./g, '')
        },
        validate(){
            let valid = true

            if(this.fio.length < 6){
                this.errors.fio = true
                valid = false
            }else{
                this.errors.fio = false
            }
            if(this.phone.length < 6){
                this.errors.phone = true
                valid = false
            }else{
                this.errors.phone = false
            }
            if(this.text.length < 10){
                this.errors.text = true
                valid = false
            }else{
                this.errors.text = false
            }

            return valid
        },
        setId(data){
            this.id = data
        },
        setServerError(res = true){
            this.errors.server = res
        }
    }
}
const app = Vue.createApp(FormaApp).mount('#formaApp')