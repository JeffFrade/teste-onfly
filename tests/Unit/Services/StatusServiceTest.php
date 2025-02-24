<?php

namespace Tests\Unit\Services;

use App\Exceptions\StatusNotFoundException;
use App\Models\Status;
use App\Services\StatusService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class StatusServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $statusService;

    public function setUp(): void
    {
        parent::setUp();
        $this->statusService = new StatusService();
    }

    public function testEditStatus()
    {
        $status = $this->statusService->edit(1);

        $this->assertInstanceOf(Status::class, $status);
        $this->assertNotEmpty($status);
        $this->assertEquals('Solicitado', $status->name);
    }

    public function testWrongEditStatus()
    {
        $this->expectException(StatusNotFoundException::class);

        $this->statusService->edit(1000000000);
    }

    public function testGetAllStatus()
    {
        $status = $this->statusService->getAll();

        $this->assertInstanceOf(Collection::class, $status);
        $this->assertFalse($status->isEmpty());
        $this->assertGreaterThanOrEqual(1, $status->count());
    }
}
