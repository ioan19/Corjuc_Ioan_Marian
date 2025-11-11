
function verificaDreptunghi(laturi) {
    let laturiSortate = laturi.sort((a, b) => a - b); 

    let a = laturiSortate[0];
    let b = laturiSortate[2];

    
            
    if (laturiSortate[0] === laturiSortate[1] && laturiSortate[2] === laturiSortate[3]) {
                
        let lungime = laturiSortate[3];
        let latime = laturiSortate[0];
                
        let aria = lungime * latime;
                
        let perimetru = 2 * (lungime + latime);

        console.log(`Cele 4 numere pot reprezenta laturi ale unui dreptunghi!`);
        console.log(`Perimetrul este: ${perimetru}. Aria este: ${aria}.`);
                
            } else {
                console.log(`Cele 4 numere nu pot reprezenta laturi ale unui dreptunghi!`);
            }
        }

        let exemplu1 = [25, 4, 25, 16];
        console.log(`\nTestare cu numerele: ${exemplu1.join(', ')}`);
        verificaDreptunghi(exemplu1); 

        let exemplu2 = [13, 17, 13, 17];
        console.log(`\n Testare cu numerele: ${exemplu2.join(', ')}`);
        verificaDreptunghi(exemplu2);