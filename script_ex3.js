let numere = [15, 4, 12];

console.log("Sortare Descrescatoare");
console.log("Numerele initiale: " + numere.join(', '));

numere.sort((a, b) => b - a);

console.log("Numerele sortate descrescător: " + numere.join(', ')); // Afișează: 15, 12, 4