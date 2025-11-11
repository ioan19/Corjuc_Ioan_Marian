let laturaA = 10;
let laturaB = 10;
let laturaC = 10;

console.log(`Testare Triunghi cu laturile: ${laturaA}, ${laturaB}, ${laturaC}`);

if (laturaA + laturaB > laturaC && laturaA + laturaC > laturaB && laturaB + laturaC > laturaA) {
      
    if (laturaA === laturaB && laturaB === laturaC) {
        console.log("Cele 3 laturi FORMEAZĂ un triunghi.");
        console.log("Tipul de triunghi este: Echilateral (toate laturile egale).");
        
    } else if (laturaA === laturaB || laturaA === laturaC || laturaB === laturaC) {
        console.log("Cele 3 laturi FORMEAZĂ un triunghi.");
        console.log("Tipul de triunghi este: Isoscel (două laturi egale).");
        
    } else {
        console.log("Cele 3 laturi FORMEAZĂ un triunghi.");
        console.log("Tipul de triunghi este: Oarecare (toate laturile diferite).");
    }
    
} else {
    console.log("Laturile date NU pot forma un triunghi (nu îndeplinesc inegalitatea triunghiului).");
}