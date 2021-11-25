var total = 0, itemsCount = 0, shopIndex = 0, firstTimeClose = 0;
var shopItem = [];
var cartCount = document.getElementById("cartCounter");

$(document).ready(()=>{
    //clicking on the shopping cart icon - home
    $('#cartButton').on('click', () => {
        /*hiding inventory window*/
        $('#shoppingHomePage').hide();
        /*showing cart window*/
        $('#shoppingCartContainer').fadeIn();  
        /*update user's total*/
        $('#cartTotal').html('$'+total);
        /*calling function to add list*/
        displayItems();
        console.log(shopItem);  
    });

    //clicking on the account button
    $('#accountButton').on('click', () => {
        $('#signOutButton').toggle("swing");
    });

    

    //clicking on the "continue shopping" button - cart form
    $('#closeCart').on('click', () => {
        /*hiding cart window*/
        $('#shoppingCartContainer').hide();   
        /*showing inventory window*/
        $('#shoppingHomePage').fadeIn(); 
        /*clear list*/
        clearList();
        updateItemCountDisplay();
    });

    //clicking on the "checkout" button - cart form
    $('#cashout').on('click', () => {
        /*hiding cart window*/
        $('#shoppingCartContainer').hide();
        /*showing checkout window*/
        $('#checkoutContainer').fadeIn();  
        /*clear list*/
        clearList();  
        /*setting number of items and total in checkout summary*/
        $('#cartAm').val(itemsCount);
        var subTotal = (total * 0.88).toFixed(2);
        var gstTotal = (total * 0.12).toFixed(2);
        $('#subTotal').val('$'+subTotal);
        $('#gst').val('$'+gstTotal);
        $('#gTotal').val('$'+total);
        
        if(itemsCount == 0){
            $('#formLog').prop('disabled', true);
        }
        else{
            $('#formLog').prop('disabled', false);
        }
    });
    


    //clicking on the "cancel" button - checkout form
    $('#cancelCheckout').on('click', () => {
        /*hidding checkout window*/
        $('#checkoutContainer').fadeOut();    
        /*showing inventory window*/
        $('#shoppingHomePage').fadeIn();
        updateItemCountDisplay();
    });

    //clicking on the "finish Checkout" button - checkout form
    $('#formLog').on('click', () => {
        //getting user's id, name on card and card number
        var userID = $('#buyersID').val();
        var paymentName = $('#hldrName').val();
        var paymentNum = $('#hldrNumber').val();
        //check if the "Name on card" and "Credit card number" fields have been filled
        if(paymentName == "" || paymentNum == ""){
            $('#hldrName').css('border', "1px solid red");
            $('#hldrNumber').css('border', "1px solid red");
        }            
        else{
            //checking if the user added a prefered place, if not his original address will be stored
            if($('#buyersAddress2').val() == "" || $('#buyersAddress2').val() == " "){
                var buyerAdd = $('#buyersAddress1').val();
                var buyerDist = $('#buyersDistrict1').val();
            }
            else{
                //if added, that will be stored
                var buyerAdd = $('#buyersAddress2').val();
                var buyerDist = $('#buyersDistrict2').val();
            }

            //getting the payment method from radios
            var radios = document.querySelectorAll('input[name = "paymentMethod"]');
            let paymentMeth;
            for (radio of radios) {
                if (radio.checked) {
                    paymentMeth = radio.value;
                    break;
                }
            }

            //will create x amount of posts to the database, depending on the amount of items ordered
            for(i = 0; i < shopItem.length; i++){
                var itemName = shopItem[i][0];
                var itemQuant = shopItem[i][2];
                var priceTot = shopItem[i][3];
                priceTot *= itemQuant;
                
                //saving order into database
                $.ajax({
                    url: "php/placeOrder.php",
                    type: "POST",
                    data: {
                        userID: userID,
                        itemName: itemName,
                        itemQuant: itemQuant,
                        priceTot: priceTot,
                        buyerAdd: buyerAdd,
                        buyerDist: buyerDist,
                        paymentMeth: paymentMeth,
                        paymentName: paymentName,
                        paymentNum: paymentNum,
                        noItemEntries: shopIndex	
                    },
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            //successful placement gets redirected to receipt
                            window.location.href = "php/purchaseReceipt.php";					
                        }
                        else if(dataResult.statusCode==201){
                            //failed gets an alert
                            alert("Oops, An error occured!");
                        }
                        
                    }
                });
            }
        }
    });
});

function displayItems(){
    //checks if list has any item
    var cartListBody = document.getElementById("cartList");
    if(shopIndex > 0){
        for(x = 0; x < shopIndex; x++){
            var addImg = document.createElement('IMG');
            addImg.src = shopItem[x][1];
            addImg.setAttribute('class', 'col-md-3 toolImage dynamicCreation');
            addImg.setAttribute('id', 'itemImg'+x);
            cartListBody.appendChild(addImg);
        
            var addName = document.createElement('h2');
            addName.innerHTML = shopItem[x][0];
            addName.setAttribute('class', 'col-md-3 dynamicCreation');
            addName.setAttribute('id', 'itemh2'+x);
            cartListBody.appendChild(addName);
        
            var addQuant = document.createElement('P');
            addQuant.innerHTML = shopItem[x][2]+' pcs';
            addQuant.setAttribute('class', 'col-md-2 dynamicCreation');
            addQuant.setAttribute('id', 'itemQuant'+x);
            cartListBody.appendChild(addQuant);
        
            var addPrice = document.createElement('P');
            addPrice.innerHTML = '$'+shopItem[x][3];
            addPrice.setAttribute('class', 'col-md-2 dynamicCreation');
            addPrice.setAttribute('id', 'itemTotal'+x);
            cartListBody.appendChild(addPrice);

            var addAction = document.createElement('button');
            addAction.innerHTML = 'X';
            addAction.setAttribute('class', 'col-md-2 dynamicCreation removeButton');
            addAction.setAttribute('id', x);
            addAction.setAttribute('onclick', 'removeItem(this)');
            cartListBody.appendChild(addAction);
        }
    }
}

//removing the dynamically created data from the cart form
function clearList(){
    //getting parent object (cart container)
    var parentObj = document.getElementById("cartList");
    //getting the dynamically created items
    var createdObjs = document.querySelectorAll('.dynamicCreation');
    //first 3 times do not get the correct items, dummy clear is done
    if(firstTimeClose == 0){
        for(t = 0; t < 3; t++)
            parentObj.removeChild(parentObj.childNodes[0]);
        firstTimeClose = 1;
    }
    //removing the actual dynamically created items
    for(y = 0; y < createdObjs.length; y++){
        parentObj.removeChild(parentObj.childNodes[0]);
    }
}

function queueItemNew(itemName){
    /*getting price and value as a string*/
    var itemPrice = document.getElementById(itemName+'Price').innerHTML;
    var itemAmount= document.getElementById(itemName+'Input').value;
    /*convert fetched items into INTs*/
    var convertedPricez = parseInt(itemPrice,  10);
    var convertedValuez = parseInt(itemAmount, 10);

    /*validation - converted input and input box*/
    if(convertedValuez <= 0 || itemAmount == "")
        /*highlight incorrect value, less than 1 or empty*/
        document.getElementById(itemName+'Input').style.border = "1px solid red";
    else{
        /*track the amount of items in cart*/
        itemsCount += convertedValuez;
        /*unhighlight box if it was/wasnt highlighted*/
        document.getElementById(itemName+'Input').style.border = "1px solid black";
        //update cart item displayed in navbar
        cartCount.value = itemsCount;

        /*track user's total*/
        total +=  (convertedPricez * convertedValuez);

        //ADDING ITEM TO CART
        //getting item source image
        var itemImgSrc = document.getElementById(itemName+'Image').src;
        //storing item as: Name, image source, quantity, price
        shopItem[shopIndex] = [itemName, itemImgSrc, convertedValuez, convertedPricez]
        shopIndex++;

        //clear input box
        document.getElementById(itemName+'Input').value = " ";
    }
}

function removeItem(button){
    //getting id of button selected
    var objId = button.id;

    //hidding selected item
    $('#itemImg'+objId).fadeOut();
    $('#itemh2'+objId).fadeOut();
    $('#itemQuant'+objId).fadeOut();
    $('#itemTotal'+objId).fadeOut();
    $('#'+objId).fadeOut();

    //lowering the tracker of the items in array
    shopIndex--;

    //storing data of item to be removed
    var objRemoved = shopItem.splice(objId, 1);

    //deduction the amount of items removed from the item tracker(displayed)
    var removeQuant = objRemoved[0][2];
    itemsCount -= removeQuant;

    //discounting the price from the total
    var removePrice = objRemoved[0][3];
    var discount = removeQuant * removePrice;
    total -= discount;
}

function updateItemCountDisplay(){
    cartCount.value = itemsCount;
}