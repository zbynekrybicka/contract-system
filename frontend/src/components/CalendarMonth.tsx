import { DateTime } from "luxon"
import { useEffect, useState, type JSX } from "react"
import type { Meeting } from "../services/api/meetingApi"
import { distributeAppointments } from "../helpers/distributeAppointments"
import type { Contact } from "../services/api/contactApi"

type Props = {
    meetingList: Meeting[]
}

export default function CalendarMonth({ meetingList }: Props): JSX.Element
{
    /**
     * Selected month (0 = current, negative = previous, positive = next)
     */
    const [ month, setMonth ] = useState(0)


    /**
     * First day of selected interval
     * Last day of selected interval
     * Count of weeks (usually 6, sometimes 5)
     * Timestamp Format
     * Handle previous month
     * Handle next month
     * Handle current month
     * Readable First Day
     * Readable Last Day
     */
    const firstDay: DateTime = DateTime.now().startOf("month").plus({ months: month }).startOf("week")
    const lastDay: DateTime = firstDay.plus({ months: 1 }).endOf("week")
    const countOfWeeks: number = Math.floor((lastDay.toMillis() - firstDay.toMillis()) / 1000 / 3600 / 24 / 7 )
    const timestampFormat: string = "yyyy-MM-dd"
    const handlePrevMonth: () => void = () => setMonth(month - 1)
    const handleNextMonth: () => void = () => setMonth(month + 1)
    const handleCurrentMonth: () => void = () => setMonth(0)
    const readableFirstDay: string = firstDay.toFormat("dd. MM.")
    const readableLastDay: string = lastDay.toFormat("dd. MM. yyyy")


    /**
     * When day is changed or window resized
     */
    distributeAppointments(meetingList, useEffect, [month], timestampFormat)


    /**
     * Meeting filter
     * 
     * @param meeting Meeting
     * @returns boolean
     */
    const meetingFilter: (meeting: Meeting) => boolean = (meeting) => {
        /**
         * Meeting appoint in string
         */
        const appointment = DateTime.fromISO(meeting.appointment)

        return appointment >= firstDay && appointment <= lastDay
    }


    /**
     * Meeting cell
     * 
     * @param meeting Meeting
     * @returns JSX.Element
     */
    const meetingCell: (meeting: Meeting) => JSX.Element = (meeting) => {
        const appointment = DateTime.fromISO(meeting.appointment)
        return <div className="calendar-event meeting" key={meeting.id} data-meeting-id={meeting.id}>
            {appointment.toFormat('dd.MM HH:mm')}
            {meeting.participants.map((participant: Contact): JSX.Element => <div key={participant.id}>{participant.lastName}</div>)}
        </div>
    }


    /**
     * 
     * @param _null null
     * @param weekIndex number
     * @returns JSX.Element
     */
    const weekRow: (_null: null, index: number) => JSX.Element = (_i, weekIndex) => {

        /**
         * 
         * @param _null null
         * @param dayIndex number
         * @returns JSX.Element
         */
        const dayCell: (_null: null, index: number) => JSX.Element = (_null, dayIndex: number) => {

            /**
             * Timestamp for attach calendar events
             * key
             */
            const timestamp: string | null = firstDay.plus({ weeks: weekIndex, days: dayIndex }).toFormat(timestampFormat) 
            const key = weekIndex + "-" + dayIndex

            return <div key={key} className="calendar-day calendar-interval" data-timestamp={timestamp}>&nbsp;</div>
        }

        return <div className="calendar-week" key={weekIndex}>{new Array(7).fill(null).map(dayCell)}</div>
    }

    return <div>
        <div className="row">
            <button onClick={handlePrevMonth}>&lt;&lt;&lt;</button>
            {readableFirstDay}
            <button onClick={handleCurrentMonth}>NOW</button>
            {readableLastDay}
            <button onClick={handleNextMonth}>&gt;&gt;&gt;</button>
        </div>
        <div className="calendar-month">{new Array(countOfWeeks).fill(null).map(weekRow)}</div>
        {meetingList.filter(meetingFilter).map(meetingCell)}
    </div>
}