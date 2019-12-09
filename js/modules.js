function drawProducts(products) {
    products.forEach(function(product) {
        $('#produtos').append(`
            <div class="produto">
                <div class="foto_produto">
                    <img src="img/pepperoni.jpg" class="produto_imagem" alt="Pizza Pepperoni">
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
                        <a>
                            Detalhes
                        </a>
                    </div>
                </div>
            </div>  
        `);
    });
}