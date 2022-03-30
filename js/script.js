const getAddressInput = document.querySelector('input#cepAddress') // Data
const getAddressBtn = document.querySelector('button#cepAddressBtn') // Trigger

const table = document.querySelector('.table')
const container = document.querySelector('div.container table tbody') // Data container

const spinner = document.querySelector('.spinner-border')
const alert = document.querySelector('.alert')

window.onload = () => {
    spinner.style.display = 'none'
    table.style.display = 'none'
    alert.style.display = 'none'
}

getAddressBtn.addEventListener('click', () => {

    
    const cep = getAddressInput.value
    
    if (cep === '') {
        
        alert.style.display = 'unset'
        
    } else {
        spinner.style.display = 'unset'

        url = `ajax.php?cep=${cep}`
        const xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                container.innerHTML = this.responseText
                spinner.style.display = 'none'
                table.style.display = ''
            }
        }

        xhr.open('GET', url, true)
        xhr.send()
    }

})
