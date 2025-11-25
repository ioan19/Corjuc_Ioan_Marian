const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

const divDetalii = document.getElementById('detalii');
const btnDetalii = document.getElementById('btnDetalii');
const spanData = document.getElementById('dataProdus');

divDetalii.classList.add('ascuns');

const dataCurenta = new Date();
const ziua = dataCurenta.getDate();
const luna = luni[dataCurenta.getMonth()];
const anul = dataCurenta.getFullYear();

spanData.textContent = `${ziua} ${luna} ${anul}`;

btnDetalii.addEventListener('click', function() {
    divDetalii.classList.toggle('ascuns');

    if (divDetalii.classList.contains('ascuns')) {
        btnDetalii.textContent = "Afișează detalii";
    } else {
        btnDetalii.textContent = "Ascunde detalii";
    }
});