let isPalindrome = (x, caseSensitive = false) => {

    // remove special caracters
    let str = x.toString().trim().replace(/[,.\s:]/g, "");

    const strLength = str.length;
    let isPalindrome = false;
    let startSlicingFrom = null;

    // check length cases
    startSlicingFrom = strLength % 2 == 0 ? strLength / 2 : strLength / 2 + 1;

    let strPartOne = str.slice(0, startSlicingFrom);
    let strPartTwo = str.slice(strLength / 2);

    // reverse str part two
    strPartTwo = strPartTwo.split("").reverse().join("");

    // convert str to small letters if case sensitive = true
    if (caseSensitive == true) {
        strPartOne = strPartOne.toLocaleLowerCase();
        strPartTwo = strPartTwo.toLocaleLowerCase();
    }

    if (strPartOne == strPartTwo) {
        isPalindrome = true;
    }

    return isPalindrome;
};


// ----------cases ------------------

// 1- case one number even  -> 12321
// 2- case one number odd   -> 123321
// ----------------------------------------------------------
// 3- case string even      -> 'radar'
// 4- case string odd       -> 'A man, a plan, a canal: Panama'
// ----------------------------------------------------------
// 5- case sensitive (true)
// 6- case sensitive (false)
// ----------------------------------------------------------

console.log(isPalindrome(12321)); // true
console.log(isPalindrome(123321)); // true

console.log(isPalindrome("radar")); // true
console.log(isPalindrome("a man, a plan, a canal: panama")); // true

console.log(isPalindrome("A man, a plan, a canal: Panama",true)); // true
console.log(isPalindrome("A man, a plan, a canal: Panama")); // false
