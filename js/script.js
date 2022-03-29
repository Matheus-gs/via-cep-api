const getCepInput = document.querySelector('input#cepAddress') // Data
const getCepBtn = document.querySelector('button#cepAddressBtn') // Trigger

const container = document.querySelector('div.container table tbody') // Data container

getCepBtn.addEventListener('click', () => {

    const cep = getCepInput.value
    url = `ajax.php?cep=${cep}`

    const xhr = new XMLHttpRequest()

    xhr.onreadystatechange =  function () {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.responseText
        }
    }

    xhr.open('GET', url, true)
    xhr.send()

})
