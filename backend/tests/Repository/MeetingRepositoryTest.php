<?php
namespace App\Tests\Repository;

use App\Entity\MeetingEntity;
use App\Repository\MeetingRepository;

final class MeetingRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataGetByContact
     */
    public function testGetByContact(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->getByContact();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetByContact(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataGetAll
     */
    public function testGetAll(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->getAll();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetAll(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataGetOne
     */
    public function testGetOne(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->getOne();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetOne(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataInsert
     */
    public function testInsert(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->insert();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataInsert(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->update();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataUpdate(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataDelete
     */
    public function testDelete(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->delete();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataDelete(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataGetCountByUser
     */
    public function testGetCountByUser(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var MeetingEntity $meeting */
        $meeting = $meetingRepository->getCountByUser();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetCountByUser(): array
    {
        return [
        ];
    }

    
}