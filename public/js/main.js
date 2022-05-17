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

    return date.replace(/(\d*)-(\d*)-(\d*) (\d*):(\d*).*/, '$3/$2/$1 $4:$5');
}
