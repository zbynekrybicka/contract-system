import { useState } from "react"
import { useAppDispatch } from "../hooks"
import { useGetMeetingQuery } from "../services/api/meetingApi"
import CalendarWeek from "./CalendarWeek"
import CalendarMonth from "./CalendarMonth"
import CalendarDay from "./CalendarDay"
import CalendarAll from "./CalendarAll"

export default function Calendar() {
    const dispatch = useAppDispatch()
    const { data: meetingList, isLoading: isMeetingListLoading } = useGetMeetingQuery({})
    const [ type, setType] = useState("week")


    return <div>
        <h2>
            <div className="inner-content">Calendar</div>
        </h2>
        <div className="inner-content route calendar">
            <button onClick={() => setType("month")}>Month</button>
            <button onClick={() => setType("week")}>Week</button>
            <button onClick={() => setType("day")}>Day</button>
            <button onClick={() => setType("all")}>All</button>
            <hr/>
            {isMeetingListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <>
                {type === "month" && <CalendarMonth meetingList={meetingList} />}
                {type === "week" && <CalendarWeek meetingList={meetingList} />}
                {type === "day" && <CalendarDay meetingList={meetingList} />}
                {type === "all" && <CalendarAll meetingList={meetingList} />}
            </>}
        </div>
    </div>
}