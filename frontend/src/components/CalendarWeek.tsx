import { useEffect } from "react"
import { DateTime } from "luxon"

export default function CalendarWeek({ meetingList })
{
    const elementPages: any = {}
    const distributeAppointments = () => {
        for (const meeting of meetingList) {

            const appointment = DateTime.fromISO(meeting.appointment)
            const calendarSelector = '.calendar-interval[data-timestamp="' + appointment.toLocal() + '"]'
            const calendarElement = document.querySelector(calendarSelector)

            const meetingSelector = '.calendar-event.meeting[data-meeting-id="' + meeting.id + '"]'
            const meetingElement = document.querySelector(meetingSelector)

            meetingElement.style.left = calendarElement?.offsetLeft + "px"
            meetingElement.style.top = calendarElement?.offsetTop + "px"

            // console.log([meeting.appointment, appointment, calendarSelector, meetingSelector, calendarElement, meetingElement, innerWidth])
        }
    }

    useEffect(distributeAppointments, [])
    window.addEventListener("resize", distributeAppointments)

    return <div className="calendar-week">
        {["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"].map((day: string, index: number) => <div className="calendar-day" key={index}>
            {[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23].map((hour: number) => <div key={hour} className="calendar-hour">
                {[0, 15, 30, 45].map((minutes: number) => {
                    const now = DateTime.now()
                    const mondayStart = now.set({ weekday: 1 }).startOf("day")
                    const calendarTime = mondayStart.plus({ days: index }).plus({ hours: hour }).plus({ minutes })
                    return <div key={hour * 60 + minutes} className="calendar-interval" data-timestamp={calendarTime.toLocal()}>&nbsp;</div>
                })}
            </div>)}
        </div>)}
        {meetingList.map(meeting => <div className="calendar-event meeting" key={meeting.id} data-meeting-id={meeting.id}>{meeting.appointment}</div>)}
    </div>
}