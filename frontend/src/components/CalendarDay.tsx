import { DateTime } from "luxon"
import { useEffect, useState } from "react"

export default function CalendarDay({ meetingList })
{
    const [ day, setDay ] = useState(DateTime.now().toISODate())

    const dayStart = DateTime.fromISO(day).startOf("day")

    const distributeAppointments = () => {
        for (const meeting of meetingList) {

            const appointment = DateTime.fromISO(meeting.appointment)
            const calendarSelector = '.calendar-interval[data-timestamp="' + appointment.toLocal() + '"]'
            const calendarElement = document.querySelector(calendarSelector)

            const meetingSelector = '.calendar-event.meeting[data-meeting-id="' + meeting.id + '"]'
            const meetingElement = document.querySelector(meetingSelector)

            if (meetingElement && calendarElement) {
                meetingElement.style.left = calendarElement?.offsetLeft + "px"
                meetingElement.style.top = calendarElement?.offsetTop + "px"
                meetingElement.style.width = calendarElement?.offsetWidth + "px"
            }

            // console.log([meeting.appointment, appointment, calendarSelector, meetingSelector, calendarElement, meetingElement, innerWidth])
        }
    }

    useEffect(distributeAppointments, [day])
    window.addEventListener("resize", distributeAppointments)


    return <div>
        <div className="row">
            <input type="date" defaultValue={day} onChange={e => setDay(e.target.value)} />
        </div>
        <div className="calendar-day">
            {[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23].map((hour: number) => <div key={hour} className="calendar-hour">
                {[0, 15, 30, 45].map((minutes: number) => {
                    const calendarTime = dayStart.plus({ hours: hour, minutes })
                    return <div key={hour * 60 + minutes} className="calendar-interval" data-timestamp={calendarTime.toLocal()}>&nbsp;</div>
                })}
            </div>)}            
        </div>
        {meetingList.filter(meeting => {
            const appointment = DateTime.fromISO(meeting.appointment).toISODate()
            return appointment === day
        }).map(meeting => {
            const appointment = DateTime.fromISO(meeting.appointment)
            return <div className="calendar-event meeting" key={meeting.id} data-meeting-id={meeting.id}>
                {appointment.toFormat('dd.MM HH:mm')}
                {meeting.participants.map(participant => <div key={participant.id}>{participant.lastName}</div>)}
            </div>
        })}
    </div>
}