<?php
if (!file_exists(include_once('models/DAO/MySqlConnection.php'))) 
    include_once('models/DAO/MySqlConnection.php');

if (!file_exists(include_once('models/CategorySubcategoryProduct.php'))) 
    include_once('models/CategorySubcategoryProduct.php');

if (!file_exists(include_once('models/Category.php'))) 
    include_once('models/Category.php');

if (!file_exists(include_once('models/Subcategory.php'))) 
    include_once('models/Subcategory.php');

if (!file_exists(include_once('models/Product.php'))) 
    include_once('models/Product.php');

class CategorySubcategoryProductDAO {
    private $connection;

    public function __construct() {
        $mySqlConnection = new MySqlConnection();
        $this->connection = $mySqlConnection->connect();
    }

    public function insert(CategorySubcategoryProduct $categorySubcategoryProduct) {
        $sql = 'INSERT INTO categorias_subcategorias_produtos (id_categoria, id_subcategoria, id_produto)
                VALUES (?, ?, ?)';
        
        $stm = $this->connection->prepare($sql);
        $stmData = array(
            $categorySubcategoryProduct->getCategory()->getId(), 
            $categorySubcategoryProduct->getSubcategory()->getId(),
            $categorySubcategoryProduct->getProduct()->getId()
        );

        return $stm->execute($stmData);
    }

    public function selectAll() {
        $sql = 'SELECT categorias_subcategorias_produtos.*, produtos.nome, produtos.descricao, produtos.preco, produtos.desconto, produtos.produto_mes, produtos.imagem, categorias.nome AS categoria, subcategorias.nome AS subcategoria, produtos.status
                FROM categorias_subcategorias_produtos
                INNER JOIN produtos
                ON categorias_subcategorias_produtos.id_produto = produtos.id
                INNER JOIN categorias
                ON categorias_subcategorias_produtos.id_categoria = categorias.id
                INNER JOIN subcategorias
                ON categorias_subcategorias_produtos.id_subcategoria = subcategorias.id';
        $select = $this->connection->query($sql);

        $categories_subcategories_products = array();

        while ($rsCategorySubcategoryProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $categories_subcategories_products[] = new CategorySubcategoryProduct(new Category($rsCategorySubcategoryProduct['categoria'], true, $rsCategorySubcategoryProduct['id_categoria']), new Subcategory($rsCategorySubcategoryProduct['subcategoria'], true, $rsCategorySubcategoryProduct['id_subcategoria']), new Product($rsCategorySubcategoryProduct['nome'], $rsCategorySubcategoryProduct['descricao'], $rsCategorySubcategoryProduct['preco'], $rsCategorySubcategoryProduct['desconto'], $rsCategorySubcategoryProduct['produto_mes'], $rsCategorySubcategoryProduct['imagem'], $rsCategorySubcategoryProduct['status'], $rsCategorySubcategoryProduct['id_produto']), $rsCategorySubcategoryProduct['id']);

        return $categories_subcategories_products;
    }

    public function deleteByProductId($idProduct) {
        $sql = "DELETE FROM categorias_subcategorias_produtos WHERE id_produto={$idProduct}";
    
        return $this->connection->query($sql);
    }

    public function selectByProductId($idProduct) {
        $sql = 'SELECT categorias_subcategorias_produtos.*, produtos.nome, produtos.descricao, produtos.preco, produtos.desconto, produtos.produto_mes, produtos.imagem, categorias.nome AS categoria, subcategorias.nome AS subcategoria, produtos.status
                FROM categorias_subcategorias_produtos
                INNER JOIN produtos
                ON categorias_subcategorias_produtos.id_produto = produtos.id
                INNER JOIN categorias
                ON categorias_subcategorias_produtos.id_categoria = categorias.id
                INNER JOIN subcategorias
                ON categorias_subcategorias_produtos.id_subcategoria = subcategorias.id
                WHERE id_produto=' . $idProduct;
        $select = $this->connection->query($sql);

        $categories_subcategories_products = array();

        while ($rsCategorySubcategoryProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $categories_subcategories_products[] = new CategorySubcategoryProduct(new Category($rsCategorySubcategoryProduct['categoria'], true, $rsCategorySubcategoryProduct['id_categoria']), new Subcategory($rsCategorySubcategoryProduct['subcategoria'], true, $rsCategorySubcategoryProduct['id_subcategoria']), new Product($rsCategorySubcategoryProduct['nome'], $rsCategorySubcategoryProduct['descricao'], $rsCategorySubcategoryProduct['preco'], $rsCategorySubcategoryProduct['desconto'], $rsCategorySubcategoryProduct['produto_mes'], $rsCategorySubcategoryProduct['imagem'], $rsCategorySubcategoryProduct['status'], $rsCategorySubcategoryProduct['id_produto']), $rsCategorySubcategoryProduct['id']);

        return $categories_subcategories_products;
    }

    public function selectByCategoryId($idCategory) {
        $sql = 'SELECT categorias_subcategorias_produtos.*, produtos.nome, produtos.descricao, produtos.preco, produtos.desconto, produtos.produto_mes, produtos.imagem, categorias.nome AS categoria, subcategorias.nome AS subcategoria, produtos.status
                FROM categorias_subcategorias_produtos
                INNER JOIN produtos
                ON categorias_subcategorias_produtos.id_produto = produtos.id
                INNER JOIN categorias
                ON categorias_subcategorias_produtos.id_categoria = categorias.id
                INNER JOIN subcategorias
                ON categorias_subcategorias_produtos.id_subcategoria = subcategorias.id
                WHERE id_categoria=' . $idCategory;
        $select = $this->connection->query($sql);

        $categories_subcategories_products = array();

        while ($rsCategorySubcategoryProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $categories_subcategories_products[] = new CategorySubcategoryProduct(new Category($rsCategorySubcategoryProduct['categoria'], true, $rsCategorySubcategoryProduct['id_categoria']), new Subcategory($rsCategorySubcategoryProduct['subcategoria'], true, $rsCategorySubcategoryProduct['id_subcategoria']), new Product($rsCategorySubcategoryProduct['nome'], $rsCategorySubcategoryProduct['descricao'], $rsCategorySubcategoryProduct['preco'], $rsCategorySubcategoryProduct['desconto'], $rsCategorySubcategoryProduct['produto_mes'], $rsCategorySubcategoryProduct['imagem'], $rsCategorySubcategoryProduct['status'], $rsCategorySubcategoryProduct['id_produto']), $rsCategorySubcategoryProduct['id']);

        return $categories_subcategories_products;
    }
    
    public function selectByCategoryAndSubcategoryId($idCategory, $idSubcategory) {
        $sql = 'SELECT categorias_subcategorias_produtos.*, produtos.nome, produtos.descricao, produtos.preco, produtos.desconto, produtos.produto_mes, produtos.imagem, categorias.nome AS categoria, subcategorias.nome AS subcategoria, produtos.status
                FROM categorias_subcategorias_produtos
                INNER JOIN produtos
                ON categorias_subcategorias_produtos.id_produto = produtos.id
                INNER JOIN categorias
                ON categorias_subcategorias_produtos.id_categoria = categorias.id
                INNER JOIN subcategorias
                ON categorias_subcategorias_produtos.id_subcategoria = subcategorias.id
                WHERE id_categoria=' . $idCategory . ' AND id_subcategoria=' . $idSubcategory;
        $select = $this->connection->query($sql);

        $categories_subcategories_products = array();

        while ($rsCategorySubcategoryProduct = $select->fetch(PDO::FETCH_ASSOC)) 
            $categories_subcategories_products[] = new CategorySubcategoryProduct(new Category($rsCategorySubcategoryProduct['categoria'], true, $rsCategorySubcategoryProduct['id_categoria']), new Subcategory($rsCategorySubcategoryProduct['subcategoria'], true, $rsCategorySubcategoryProduct['id_subcategoria']), new Product($rsCategorySubcategoryProduct['nome'], $rsCategorySubcategoryProduct['descricao'], $rsCategorySubcategoryProduct['preco'], $rsCategorySubcategoryProduct['desconto'], $rsCategorySubcategoryProduct['produto_mes'], $rsCategorySubcategoryProduct['imagem'], $rsCategorySubcategoryProduct['status'], $rsCategorySubcategoryProduct['id_produto']), $rsCategorySubcategoryProduct['id']);

        return $categories_subcategories_products;
    }
}
?> 