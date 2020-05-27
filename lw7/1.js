function isPrime(n) {
    if (typeof n === 'undefined')
    {
        console.log("Некорректный параметр");
        return;
    }
    if (typeof n !== 'number' && !Array.isArray(n)) {
        console.log(n.toString(), " не является числом");
        return;
    }
    if (typeof n === 'number')
    {
        if (n < 2) {
            console.log(n.toString(), " - число должно быть больше 2");
            return;
        } else if (n === 2) {
            console.log(n.toString(), " - простое число");
            return;
        }
    }

    if (!Array.isArray(n)) {
        n = [n];
    }
    for (let element of n) {
        let numberState = " не является числом";
        if (typeof element === 'number')
        {
            let i = 2;
            const limit = Math.sqrt(element);
            numberState = " - простое число";
            while (i <= limit) {
                if (element % i === 0) {
                    numberState = " - составное число";
                }
                i += 1;
            }
        }
        console.log(element.toString(), numberState, '\n');
    }
}