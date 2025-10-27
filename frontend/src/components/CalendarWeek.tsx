import { useEffect, useState } from "react"
import { DateTime } from "luxon"

export default function CalendarWeek({ meetingList })
{
    const [ week, setWeek ] = useState(0)

    const now = DateTime.now()
    const thisMonday = now.set({ weekday: 1 }).startOf("day")
    const mondayStart = thisMonday.plus({ days: week * 7 })
    const sundayEnd = mondayStart.plus({ days: 6, hours: 23, minutes: 59 })

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

    useEffect(distributeAppointments, [week])
    window.addEventListener("resize", distributeAppointments)

    return <div>
        <div className="row">
            <button onClick={() => setWeek(week - 1)}>&lt;&lt;&lt;</button> {mondayStart.toFormat("dd. MM.")} <button onClick={() => setWeek(0)}>NOW</button> {sundayEnd.toFormat("dd. MM. yyyy")} <button onClick={() => setWeek(week + 1)}>&gt;&gt;&gt;</button>
        </div>
        <div className="calendar-week">
            {["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"].map((day: string, index: number) => <div className="calendar-day" key={index}>
                {[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23].map((hour: number) => <div key={hour} className="calendar-hour">
                    {[0, 15, 30, 45].map((minutes: number) => {
                        const calendarTime = mondayStart.plus({ days: index, hours: hour, minutes })
                        return <div key={hour * 60 + minutes} className="calendar-interval" data-timestamp={calendarTime.toLocal()}>&nbsp;</div>
                    })}
                </div>)}
            </div>)}
            {meetingList.filter(meeting => {
                const appointment = DateTime.fromISO(meeting.appointment)
                return appointment >= mondayStart && appointment <= sundayEnd
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