const btnAdauga = document.getElementById('btnAdauga');
const inputActivitate = document.getElementById('inputActivitate');
const lista = document.getElementById('listaActivitati');

const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

btnAdauga.addEventListener('click', function() {
    const textActivitate = inputActivitate.value;

    if (textActivitate !== "") {
        
        const elementNou = document.createElement('li');

        const dataCurenta = new Date();
        const ziua = dataCurenta.getDate();
        const lunaIndex = dataCurenta.getMonth();
        const lunaText = luni[lunaIndex];
        const anul = dataCurenta.getFullYear();

        elementNou.textContent = `${textActivitate} – adăugată la: ${ziua} ${lunaText} ${anul}`;

        lista.appendChild(elementNou);

        inputActivitate.value = "";
    } else {
        alert("Te rog introdu o activitate!");
    }
});