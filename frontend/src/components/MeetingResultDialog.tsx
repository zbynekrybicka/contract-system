import { useState, type ChangeEvent, type JSX } from "react"
import { usePutMeetingMutation, type Meeting } from "../services/api/meetingApi"
import { DateTime } from "luxon"

type Props = {
    meeting: Meeting,
    handleCloseForm: () => void
}

export default function MeetingResultDialog({ meeting, handleCloseForm }: Props): JSX.Element
{
    /**
     * Meeting Result
     * Meeting Result Type
     * Contract Price
     * Next Meeting Appointment
     * Next Meeting Place
     */
    const [ result, setResult ] = useState<string>("")
    const [ type, setType ] = useState<string>("")
    const [ price, setPrice ] = useState<string>("")
    const [ nextMeeting, setNextMeeting ] = useState<DateTime | null>(null)
    const [ place, setPlace ] = useState<string>("")


    /**
     * Set Meeting Result
     * Set Meeting Result Type
     * Set Contract Price
     * Set Next Meeting Appointment
     * Set Next Meeting Place
     */
    const handleSetResult: (event: ChangeEvent<HTMLTextAreaElement>) => void = (event) => setResult(event.target.value)
    const handleSetType: (event: ChangeEvent<HTMLSelectElement>) => void = (event) => setType(event.target.value)
    const handleSetPrice: (event: ChangeEvent<HTMLInputElement>) => void = (event) => setPrice(event.target.value)
    const handleSetNextMeeting: (event: ChangeEvent<HTMLInputElement>) => void = (event) => setNextMeeting(DateTime.fromISO(event.target.value))
    const handleSetPlace: (event: ChangeEvent<HTMLInputElement>) => void = (event) => setPlace(event.target.value)


    /**
     * Readable Next Meeting
     */
    const readableNextMeeting: string | undefined = nextMeeting?.toISO() || undefined


    /**
     * POST /call
     * 
     * @param data MeetingResultForm
     */
    const [ putMeeting, { isLoading }] = usePutMeetingMutation()
    function handleSaveMeetingResult() {
        putMeeting({
            id: meeting.id,
            result,
            type,
            price,
            nextMeeting: nextMeeting?.toISO() || null,
            place
        }).then(handleCloseForm)
    }


    /**
     * Dialog Header
     */
    const dialogHeader: JSX.Element = <div className="header">
        Meeting Result 
        <button className="close" onClick={handleCloseForm}>X</button>
    </div>


    /**
     * Meeting Info
     */
    const meetingInfo: JSX.Element = <div>
        {DateTime.fromISO(meeting.appointment).toFormat("dd.MM.yyyy HH:mm")}
        {meeting.participants.map(participant => <div>{participant.firstName} {participant.middleName} {participant.lastName}</div>)}
    </div>


    /**
     * Input Meeting Result
     */
    const inputMeetingResult: JSX.Element = <label>
        Meeting Result 
        <textarea name="result" defaultValue={result} onChange={handleSetResult}></textarea>
    </label>


    /**
     * Select Type
     */
    const selectType: JSX.Element = <label>
        <select name="type" defaultValue={type} onChange={handleSetType}>
            <option></option>
            <option value="contract">Opened contract</option>
            <option value="rejected">Rejected</option>
            <option value="postponed">Postponed until later</option>
        </select>
    </label>


    /**
     * Input Price
     */
    const inputPrice: JSX.Element = <label>
        Price 
        <input type="text" name="price" defaultValue={price} onChange={handleSetPrice}/>
    </label>


    /**
     * Input Next Meeting
     */
    const inputNextMeeting: JSX.Element = <label>
        Next Meeting 
        <input type="datetime-local" name="next-call" defaultValue={readableNextMeeting} onChange={handleSetNextMeeting} />
    </label>


    /**
     * Input Place
     */
    const inputPlace: JSX.Element = <label>
        Place 
        <input type="text" name="place" defaultValue={place} onChange={handleSetPlace}/>
    </label>


    /**
     * Button Save Meeting Result
     */
    const buttonSaveMeetingResult: JSX.Element = <button className="save-result" onClick={handleSaveMeetingResult}>Save Meeting Result</button>


    return <div className="dialog-background">
        <div className="dialog edit-contact">
            {dialogHeader}{meetingInfo}<hr/>
            {inputMeetingResult}{selectType}{inputPrice}{inputNextMeeting}{inputPlace}
            <div className="footer">{isLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : buttonSaveMeetingResult}</div>
        </div>
    </div>
}