<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>
            Frajola's Pizzaria
        </title>
        
        <link rel="icon" href="img/logo.png">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link href="css/flickity.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="js/jquery.js"></script>
    </head>

    <body>
        <!-- Cabeçalho -->
        <?php
            if (!file_exists(include_once("./include/header.php")))
                include_once("./include/header.php");
        ?>
        
        <!-- Slider -->
        <?php 
            if (!file_exists(include_once("./include/slider.php")))
                include_once("./include/slider.php");
        ?>
        
        <!-- Loja -->
        <section id="loja">

            <!-- Validação no W3C -->
            <h2 class="nothing">
                nothing
            </h2>
            
            <div class="conteudo center">

                <!-- Redes sociais -->
                <?php
                    if (!file_exists(include_once("./include/redes_sociais.php")))
                        include_once("./include/redes_sociais.php");
                ?>

                <!-- Menu de navegação da loja -->
                <nav id="area_menu_cardapio">
                    <ul id="menu_cardapio">
                
                    </ul>
                </nav>
                
                <!-- Produtos -->
                <div id="produtos">
                    
                </div>
            </div>
        </section>
        
        <!-- Rodapé -->
        <?php
            if (!file_exists(include_once("./include/footer.php")))
                include_once("./include/footer.php");
        ?>
        
        <script src="js/jquery.js"></script>
        <script src="js/flickity.js"></script>
        <script src="js/slider.js"></script>
        <script src="js/modules.js"></script>
        <script src="pms/js/modules.js"></script>
        <script>
            function getShuffledArr(arr) {
                const newArr = arr.slice();
                for (let i = newArr.length - 1; i > 0; i--) {
                    const rand = Math.floor(Math.random() * (i + 1));
                    [newArr[i], newArr[rand]] = [newArr[rand], newArr[i]];
                }
                return newArr;
            };

            $(document).ready(function() {
                selectAll('categorySubcategoryProduct', function(data) {
                    let products = [];

                    data.find(function(product, i) {
                        products.push({ name: product.name, description: product.description, price: product.price }); 
                    });

                    products = products.filter((product, i) => i === products.findIndex((product2) => (product.name === product2.name && product.description === product2.description && product.price === product2.price)));
                    products = getShuffledArr(products);

                    drawProducts(products);
                });
            });

            $(document).ready(function() {
                selectAll('category', function(data) {
                    data.forEach(function(category) {
                        $('#menu_cardapio').append(`
                            <li class="menu_cardapio_itens" data-id="${category.id}"> ${category.name}
                                <ul class="submenu" data-id="${category.id}">
                                    
                                </ul>
                            </li>
                        `);                  
                    });

                    const execute = true;
                    for (let i = 0; i < $('.submenu').length; i++) {
                        selectByCategoryId('categorySubcategoryProduct', $('.submenu').eq(i).data('id'), function(data) {
                            let subcategories = [];

                            data.find(function(product, i) {
                                subcategories.push(product.id_subcategory + ',' + product.subcategory); 
                            });

                            subcategories = new Set(subcategories);

                            subcategories.forEach(function(subcategory) {
                                subcategory = subcategory.split(',');
                                $('.submenu').eq(i).append(`
                                    <li class="submenu_itens" data-id="${subcategory[0]}">${subcategory[1]}</li>
                                `);

                                $('.submenu_itens').click(function(event) {
                                    const idSubcategory = event.currentTarget.dataset.id;
                                    const idCategory = event.currentTarget.offsetParent.dataset.id;

                                    selectByCategoryAndSubcategoryId('categorySubcategoryProduct', idCategory, idSubcategory, function(data) {
                                        $('#produtos').empty();

                                        let products = [];

                                        data.find(function(product, i) {
                                            products.push({ id: product.id_product, name: product.name, description: product.description, price: product.price }); 
                                        });

                                        products = products.filter((product, i) => i === products.findIndex((product2) => (product.id === product2.id)));
                                        
                                        drawProducts(products);
                                    });
                                });  
                            });
                        }); 
                    }

                    $('.menu_cardapio_itens').click(function(event) {
                        const id = event.currentTarget.dataset.id;

                        selectByCategoryId('categorySubcategoryProduct', id, function(data) {
                            $('#produtos').empty();

                            let products = [];

                            data.find(function(product, i) {
                                products.push({ name: product.name, description: product.description, price: product.price }); 
                            });

                            products = products.filter((product, i) => i === products.findIndex((product2) => (product.name === product2.name && product.description === product2.description && product.price === product2.price)));

                            drawProducts(products);
                        });
                    });  
                });
            });
        </script>
    </body>
</html>