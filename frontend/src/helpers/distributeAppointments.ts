import { DateTime } from "luxon"
import type { Meeting } from "../services/api/meetingApi"
import { useEffect } from "react"

type UseEffect = typeof useEffect

/**
 * 
 * @param meetingList 
 * @returns () => void
 */
export function distributeAppointments(meetingList: Meeting[], hook: UseEffect, dependency: any[], timestampFormat: string): void {

    const handleDistributeAppointments = () => {
        for (const meeting of meetingList) {

            const appointment = DateTime.fromISO(meeting.appointment)
            const calendarSelector = '.calendar-interval[data-timestamp="' + appointment.toFormat(timestampFormat) + '"]'
            const calendarElement: HTMLElement | null = document.querySelector(calendarSelector)

            const meetingSelector = '.calendar-event.meeting[data-meeting-id="' + meeting.id + '"]'
            const meetingElement: HTMLElement | null = document.querySelector(meetingSelector)

            if (meetingElement && calendarElement) {
                meetingElement.style.left = calendarElement.offsetLeft + "px"
                meetingElement.style.top = calendarElement.offsetTop + "px"
                meetingElement.style.width = calendarElement.offsetWidth + "px"
            }

            // console.log([meeting.appointment, appointment, calendarSelector, meetingSelector, calendarElement, meetingElement, innerWidth])
        }
    }
    hook(handleDistributeAppointments, dependency)
    hook(() => {
        window.addEventListener("resize", handleDistributeAppointments)
        return () => window.removeEventListener("resize", handleDistributeAppointments)
    }, [])
}