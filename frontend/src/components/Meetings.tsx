import type { JSX } from 'react';
import { useGetMeetingQuery, type Meeting } from '../services/api/meetingApi';
import { DateTime } from 'luxon';

export default function Meetings(): JSX.Element {
  
  /**
   * Meeting List
   * Is Meeting List Loading
   */
  const { data: meetingList, isLoading: isMeetingListLoading } = useGetMeetingQuery({});


  /**
   * @param meeting Meeting
   * @returns JSX.Element
   */
  const meetingItem: (meeting: Meeting) => JSX.Element = (meeting) => {
    const id = meeting.id
    const place: string = meeting.place
    const appointment: string = DateTime.fromISO(meeting.appointment).toFormat("dd. MM. yyyy HH:mm")
    return <li key={id}>{place} ({appointment})</li>
  }

  return <>
    <h2><div className="inner-content">Meetings</div></h2>
    <div className="inner-content route">{isMeetingListLoading ? <img src={"/src/assets/tube-spinner.svg"}/> : <ul>{meetingList?.map(meetingItem)}</ul>}</div>
  </>;
}
