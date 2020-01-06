<?php
declare(strict_types=1);

namespace Tests\Unit;


use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $tableName = 'products';

    /**
     * @runInSeparateProcess
     */
    public function testSaveProduct()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $dataProduct = factory(Product::class)->make();
        $product = new Product([
            'id' => $dataProduct->id,
            'name' => $dataProduct->name,
            'value' => $dataProduct->value,
            'quantity' => $dataProduct->quantity,
            'category_id' => $category->id,
        ]);

        $product->save();

        $this->assertDatabaseHas($this->tableName, [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $product->quantity,
            'value' => $product->value,
            'category_id' => $product->category_id,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateProduct()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $dataProduct = factory(Product::class)->make();
        $product = new Product([
            'id' => $dataProduct->id,
            'name' => $dataProduct->name,
            'value' => $dataProduct->value,
            'quantity' => $dataProduct->quantity,
            'category_id' => $category->id,
        ]);

        $product->save();

        $this->assertDatabaseHas($this->tableName, [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $product->quantity,
            'value' => $product->value,
            'category_id' => $product->category_id,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDeleteProduct()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $dataProduct = factory(Product::class)->make();
        $product = new Product([
            'id' => $dataProduct->id,
            'name' => $dataProduct->name,
            'value' => $dataProduct->value,
            'quantity' => $dataProduct->quantity,
            'category_id' => $category->id,
        ]);

        $product->save();

        $product->delete();

        $this->assertDatabaseMissing($this->tableName, [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category_id,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetProduct()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $dataProduct = factory(Product::class)->make();
        $product = new Product([
            'id' => $dataProduct->id,
            'name' => $dataProduct->name,
            'value' => $dataProduct->value,
            'quantity' => $dataProduct->quantity,
            'category_id' => $category->id,
        ]);

        $product->save();

        $productFromDb = Product::find($product->id);

        static::assertEquals($product->name, $productFromDb->name);
        static::assertEquals($product->value, $productFromDb->value);
        static::assertEquals($product->quantity, $productFromDb->quantity);
        static::assertEquals($product->category_id, $productFromDb->category_id);
    }

    /**
     * @runInSeparateProcess
     */
    public function testUpdateProduct()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $dataProduct = factory(Product::class)->make();
        $product = new Product([
            'id' => $dataProduct->id,
            'name' => $dataProduct->name,
            'value' => $dataProduct->value,
            'quantity' => $dataProduct->quantity,
            'category_id' => $category->id,
        ]);

        $product->save();

        $productFromDb = Product::find($product->id);

        $productFromDb->name = 'other_name';

        $productFromDb->save();

        $productFromDbUpdated = Product::find($productFromDb->id);

        static::assertEquals($productFromDb->name, $productFromDbUpdated->name);

        static::assertEquals($product->id, $productFromDb->id);

        static::assertEquals($productFromDb->id, $productFromDbUpdated->id);
        static::assertNotEquals($productFromDb, $productFromDbUpdated);

        $this->assertDatabaseMissing($this->tableName, [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category_id,
        ]);

        $this->assertDatabaseHas($this->tableName, [
            'id' => $productFromDbUpdated->id,
            'name' => $productFromDbUpdated->name,
            'category_id' => $productFromDbUpdated->category_id,
        ]);
    }
}
