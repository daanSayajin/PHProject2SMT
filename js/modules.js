function drawProducts(products) {
    products.forEach(function(product) {
        $('#produtos').append(`
            <div class="produto">
                <div class="foto_produto">
                    <img src="pms/uploads/${product.image}" class="produto_imagem" alt="Pizza Pepperoni">
                </div>
                
                <div class="informacoes_produto">
                    <p>
                        <span class="bold"> Nome: </span> ${product.name}
                    </p>

                    <p>
                        <span class="bold"> Descrição: </span> ${product.description === '' ? '-' : product.description}  
                    </p>

                    <p class="preco bold">
                        ${'R$ ' + parseFloat(product.price).toFixed(2).replace('.', ',')} 
                    </p>

                    <div id="detalhes-align">
                        <a class="details" data-id="${product.id}">
                            Detalhes
                        </a>
                    </div>
                </div>
            </div>  
        `);
    });

    $('.details').click(function(event) {
        const id = event.currentTarget.dataset.id;

        incrementClick('product', id, function(data) {
            console.log(data.status);
            alert('modal');
        });
    });
}