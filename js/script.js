const getAddressInput = document.querySelector('input#cepAddress') // Data
const getAddressBtn = document.querySelector('button#cepAddressBtn') // Trigger

const container = document.querySelector('div.container')
const table = document.querySelector('.table')
const tbody = document.querySelector('div.container table tbody')

const spinner = document.querySelector('.spinner-border')
// const alert = document.querySelector('.alert')

window.onload = () => {
    spinner.style.display = 'none'
    table.style.display = 'none'
}

getAddressBtn.addEventListener('click', () => {
    const cep = getAddressInput.value


    spinner.style.display = 'unset'

    url = `ajax.php?cep=${cep}`
    const xhr = new XMLHttpRequest()

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            tbody.innerHTML = this.responseText
            spinner.style.display = 'none'
            table.style.display = ''
        } 
    }

    xhr.open('GET', url, true)
    xhr.send()
})
