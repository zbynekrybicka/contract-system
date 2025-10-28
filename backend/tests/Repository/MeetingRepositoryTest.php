<?php
namespace App\Tests\Repository;

use App\Entity\Meeting;
use App\Repository\MeetingRepository;

final class MeetingRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataFindByContact
     */
    public function testFindByContact(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var Meeting[] $meetingList */
        $meetingList = $meetingRepository->findByContact();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataFindByContact(): array
    {
        return [
        ];
    }

    
    
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var Meeting $meeting */
        $meeting = $meetingRepository->create();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataCreate(): array
    {
        return [
        ];
    }

    





    
    /**
     * @dataProvider dataGetCountByParticipant
     */
    public function testGetCountByParticipant(): void
    {
        /** @var MeetingRepository $meetingRepository */
        $meetingRepository = static::getContainer()->get(MeetingRepository::class);

        /** @var Meeting $meeting */
        $meeting = $meetingRepository->getCountByParticipant();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }
    public static function dataGetCountByParticipant(): array
    {
        return [
        ];
    }

    
}