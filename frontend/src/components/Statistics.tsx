import { useGetUserStatisticsQuery } from "../services/api/userApi";

export default function Statistics()
{
      const { data: statistics, isLoading: isStatisticsLoading } = useGetUserStatisticsQuery(null);
    

    return <>{isStatisticsLoading ? <img src={"/src/assets/tube-spinner.svg"} height="100px" /> : <div className="table">
        <div className="row">
            <div>Contacts:</div>
            <div>{statistics.contacts}</div>
        </div>
        <div className="row">
            <div>Calls:</div>
            <div>{statistics.calls}</div>
        </div>
        <div className="row">
            <div>Meetings:</div>
            <div>{statistics.meetings}</div>
        </div>
    </div>}
    </>
}