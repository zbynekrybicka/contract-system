import { DateTime } from "luxon"
import { useEffect, useState } from "react"

export default function CalendarMonth({ meetingList })
{
    const [ month, setMonth ] = useState(0)

    const distributeAppointments = () => {
        for (const meeting of meetingList) {

            const appointment = DateTime.fromISO(meeting.appointment)
            const calendarSelector = '.calendar-day[data-timestamp="' + appointment.toISODate() + '"]'
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

    useEffect(distributeAppointments, [month])
    window.addEventListener("resize", distributeAppointments)


    const firstDay = DateTime.now().startOf("month").plus({ months: month }).startOf("week")
    const lastDay = firstDay.plus({ months: 1 }).endOf("week")
    const countOfWeeks = Math.floor((lastDay.toMillis() - firstDay.toMillis()) / 1000 / 3600 / 24 / 7 )
    const weeks = new Array(countOfWeeks).fill(null)
    return <div>
        <div className="row">
            <button onClick={() => setMonth(month - 1)}>&lt;&lt;&lt;</button> {firstDay.toFormat("dd. MM.")} <button onClick={() => setMonth(0)}>NOW</button> {lastDay.toFormat("dd. MM. yyyy")} <button onClick={() => setMonth(month + 1)}>&gt;&gt;&gt;</button>
        </div>
        <div className="calendar-month">
            {weeks.map((_i, weekIndex) => <div className="calendar-week" key={weekIndex}>
                {["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]
                    .map((day: string, dayIndex: number) => <div key={weekIndex + "-" + dayIndex} className="calendar-day" data-timestamp={firstDay.plus({ weeks: weekIndex, days: dayIndex }).toISODate()}>&nbsp;</div>)}
            </div>)}
        </div>
        {meetingList.filter(meeting => {
            const appointment = DateTime.fromISO(meeting.appointment)
            return appointment >= firstDay && appointment <= lastDay
        }).map(meeting => {
            const appointment = DateTime.fromISO(meeting.appointment)
            return <div className="calendar-event meeting" key={meeting.id} data-meeting-id={meeting.id}>
                {appointment.toFormat('dd.MM HH:mm')}
                {meeting.participants.map(participant => <div key={participant.id}>{participant.lastName}</div>)}
            </div>
        })}
    </div>
}