<?php

namespace Tests\Unit;


use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $tableName = 'categories';

    /**
     * @runInSeparateProcess
     */
    public function testSaveCategory()
    {
        $dataCategory = factory(Category::class)->make();
        $category = new Category([
            'id' => $dataCategory->id,
            'name' => $dataCategory->name,
        ]);

        $category->fill(get_object_vars($dataCategory));

        $category->save();

        $this->assertDatabaseHas($this->tableName, [
            'id' => $category->id,
            'name' => $category->name,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateCategory()
    {
        $category = factory(Category::class)->make();
        $category->save();

        $this->assertDatabaseHas($this->tableName, [
            'id' => $category->id,
            'name' => $category->name,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDeleteCategory()
    {
        $dataCategory = factory(Category::class)->make();
        $category = new Category([
            'id' => $dataCategory->id,
            'name' => $dataCategory->name,
        ]);
        $category->save();

        $category->delete();

        $this->assertDatabaseMissing($this->tableName, [
            'id' => $category->id,
            'name' => $category->name,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testUpdateCategory()
    {
        $dataCategory = factory(Category::class)->make();
        $category = new Category([
            'id' => $dataCategory->id,
            'name' => $dataCategory->name,
        ]);
        $category->save();

        $categoryFromDb = Category::find($category->id);

        $categoryFromDb->name = 'other_name';

        $categoryFromDb->save();

        $categorytFromDbUpdated = Category::find($categoryFromDb->id);

        static::assertEquals($categoryFromDb->name, $categorytFromDbUpdated->name);

        static::assertEquals($category->id, $categoryFromDb->id);

        static::assertEquals($categoryFromDb->id, $categorytFromDbUpdated->id);
        static::assertNotEquals($categoryFromDb, $categorytFromDbUpdated);

        $this->assertDatabaseMissing($this->tableName, [
            'id' => $category->id,
            'name' => $category->name,
        ]);

        $this->assertDatabaseHas($this->tableName, [
            'id' => $categorytFromDbUpdated->id,
            'name' => $categorytFromDbUpdated->name,
        ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCategory()
    {
        $dataCategory = factory(Category::class)->make();
        $category = new Category([
            'id' => $dataCategory->id,
            'name' => $dataCategory->name,
        ]);
        $category->save();

        $categoryFromDb = Category::find($category->id);

        static::assertEquals($category->name, $categoryFromDb->name);
    }
}
