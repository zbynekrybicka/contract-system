import { useGetMeetingsQuery } from '../features/meetings/meetingsApi';

export default function Meetings(){
  const { data } = useGetMeetingsQuery({});

  return <ul>{data?.map(m => <li key={m.id}>{m.title} ({new Date(m.startsAt).toLocaleString()})</li>)}</ul>;
}
