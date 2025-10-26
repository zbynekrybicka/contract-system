export default function ContactHistoryMeeting({ meeting })
{
    console.log(meeting)
    return <div>
        <div>{meeting.appointment} &ndash; {meeting.place}</div>
    </div>
}