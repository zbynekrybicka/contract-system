/**
 * NewPassword.tsx
 * 
 * Component for set new user password.
 */

import { useState, type JSX } from "react";
import { usePutUserNewPasswordMutation } from "../services/api/userApi";
import { useParams } from "react-router-dom";


export default function NewPassword(): JSX.Element
{
    const { token } = useParams<{ token: string }>()

    /**
     * Password
     * Confirm Password
     */
    const [ newPassword, setNewPassword ] = useState<string>("")
    const [ confirmPassword, setConfirmPassword ] = useState<string>("")
    const [ passwordSuccessfullySet, setPasswordSuccessfullySet ] = useState<boolean>(false)


    /**
     * PUT /user/new-password
     */
    const [ putUserNewPassword, { isLoading } ] = usePutUserNewPasswordMutation()


    /**
     * Handle Submit New Password Form
     * 
     * @param event Form Event
     */
    const handleSubmit: (event: React.FormEvent<HTMLFormElement>) => void = (event) => {
        event.preventDefault()
        if (token) {
            putUserNewPassword({ newPassword, confirmPassword, token }).then(() => setPasswordSuccessfullySet(true))
        }   
    }

    /**
     * Dialog Header
     */
    const header: JSX.Element = <div className="dialog-header">
        <h2>Set New Password</h2>
    </div>


    /**
     * Hidden Token Input
     */
    const inputToken: JSX.Element = <input type="hidden" name="token" value={token} />


    /**
     * New Password Input
     */
    const inputNewPassword: JSX.Element = <label>
        New Password:
        <input type="password" name="new-password" defaultValue={newPassword} onChange={e => setNewPassword(e.target.value)} />
    </label>


    /**
     * Confirm Password Input
     */
    const inputConfirmPassword: JSX.Element = <label>
        Confirm Password:
        <input type="password" name="confirm-password" defaultValue={confirmPassword} onChange={e => setConfirmPassword(e.target.value)} />
    </label>


    const footer: JSX.Element = <div className="dialog-footer">
        <button type="submit">Set Password</button>
    </div>


    /**
     * Set password and confirm password form
     */
    return <div className="dialog-background">
        <div className="dialog login-dialog">
            {passwordSuccessfullySet ? <div>Password has been successfully set.</div> : 
                <form onSubmit={handleSubmit}>
                    {header}
                        {inputToken}
                        {inputNewPassword}
                        {inputConfirmPassword}                   
                    {!isLoading && footer}
                </form>}
        </div>
    </div>
}