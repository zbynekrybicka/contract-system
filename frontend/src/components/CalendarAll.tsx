import { DateTime } from "luxon"
import { useState } from "react"

export default function CalendarAll({ meetingList })
{
    const [ start, setStart ] = useState(DateTime.now().toISODate())
    const [ end, setEnd ] = useState(DateTime.now().toISODate())

    return <div>
        <div className="row">
            <input type="date" defaultValue={start} onChange={e => setStart(e.target.value)} />
            <input type="date" defaultValue={end} onChange={e => setEnd(e.target.value)} />
        </div>
        <div className="calendar-all">
            {meetingList.filter(meeting => {
                const appointment = DateTime.fromISO(meeting.appointment)
                return appointment >= DateTime.fromISO(start).startOf("day") && appointment <= DateTime.fromISO(end).endOf("day")
            }).map(meeting => {
                const appointment = DateTime.fromISO(meeting.appointment)
                return <div className="calendar-event meeting" key={meeting.id} data-meeting-id={meeting.id}>
                    {appointment.toFormat('dd.MM HH:mm')}
                    {meeting.participants.map(participant => <div key={participant.id}>{participant.lastName}</div>)}
                </div>
            })}            
        </div>
    </div>
}