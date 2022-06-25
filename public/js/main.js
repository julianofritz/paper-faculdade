const formatPrice = price => {
    price = price.toString().replace(/\D/g,"");
    price = price.toString().replace(/(\d)(\d{11})$/,"$1.$2");
    price = price.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    price = price.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    price = price.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return price;
}

const formatDate = date => {
    if (date.length !== 19) {
        return date;
    }

    const dateTime = new Date(date);
    const dateFormat = dateTime.toLocaleString("pt-BR");

    // Oculta os segundos.
    return dateFormat.substring(0, dateFormat.length - 3);
}
