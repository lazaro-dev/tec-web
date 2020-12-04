function alterarCor() {
    document.getElementsByClassName('insert__select')[0].classList.toggle('focus__Red');
    document.getElementsByClassName('insert__date')[0].classList.toggle('focus__Red');
    document.getElementsByClassName('insert__text')[0].classList.toggle('focus__Red');
    document.getElementsByClassName('insert__text')[1].classList.toggle('focus__Red');
    document.getElementsByClassName('insert__submit')[0].classList.toggle('insert__submit--red');
}