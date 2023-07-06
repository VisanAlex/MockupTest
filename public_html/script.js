let receiptTotalAmount = 0;
let receiptTotalTaxAmount = 0;
let receiptTotalAmountDiv = document.getElementById('receipt-total-amount');
let receiptTotalTaxAmountDiv = document.getElementById('receipt-totaltax-amount');

function btnClick(event) {
    let productName = event.target.id.replace("-btn", "");
    let checkBox = document.getElementById(productName+'-checkbox');
    let isImported = 'No';
    let category = document.getElementById(productName+'-category').innerText.toLowerCase();
    let price = document.getElementById(productName+'-price').innerText.replace('$ ',"");
    let floatPrice = parseFloat(price);
    let tax = 0;
    let productTaxPrice = 0;
    let finalProductPrice = 0;

    if (checkBox.checked) {
        isImported = 'Yes';
    }

    if(isImported == 'Yes') {
        tax = 5;
    } else {
        tax = 0;
    }

    if(category == "books" || category == "food" || category == "medical-products") {
        tax += 0;
    } else {
        tax += 10;
    }
    
    productTaxPrice = floatPrice * tax / 100;
    productTaxPrice = Math.round(productTaxPrice*100) / 100;
    finalProductPrice = floatPrice + productTaxPrice;

    receiptTotalAmount += finalProductPrice;
    receiptTotalTaxAmount += productTaxPrice;

    let randomString = Math.random().toString(36).slice(2);
    let table = document.getElementById('tbody');
    table.innerHTML += `
    <tr id=${randomString}>
    <td>${productName}</td>
    <td>${isImported}</td>
    <td>$ ${finalProductPrice}</td>
    <td>$ ${productTaxPrice}</td>
    <td><i id="${productName}-delete-${randomString}" data="${finalProductPrice},${productTaxPrice},${randomString}" class="bi bi-trash-fill" style="color:red" onClick=deleteItem(event)></i></td>\
    `;

}

function generateReceipt() {
    receiptTotalAmountDiv.innerText = '$ '+ Math.round(receiptTotalAmount*100) / 100;
    receiptTotalTaxAmountDiv.innerText = '$ '+ Math.round(receiptTotalTaxAmount*100) / 100;
}

function deleteItem(event) {
    let values = event.target.attributes['1'].value.split(",");
    let variable1 = parseFloat(values[0]);
    let variable2 = parseFloat(values[1]);
    let variable3 = values[2];

    receiptTotalAmount -= variable1;
    receiptTotalTaxAmount -= variable2;
    let divToDelete = document.getElementById(variable3);
    divToDelete.remove();
    
}