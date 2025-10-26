import { useAppDispatch } from "../hooks";
import { useGetMeetingQuery } from "../services/api/meetingApi";
import CalendarWeek from "./CalendarWeek";

export default function Calendar() {
    const dispatch = useAppDispatch()
    const { data: meetingList, isLoading: isMeetingListLoading } = useGetMeetingQuery({});


    return <div>
        <h2>
            <div className="inner-content">Calendar</div>
        </h2>
        <div className="inner-content route calendar">
            {isMeetingListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <>
                <CalendarWeek meetingList={meetingList} />
            </>}
        </div>
    </div>
}