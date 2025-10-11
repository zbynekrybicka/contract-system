import { useAppSelector, useAppDispatch } from "../hooks";
import { useLoginMutation } from "../services/api/authApi";
import { setToken } from "../store/authSlice";
import { getEmail, getPassword, setEmail, setPassword} from "../store/loginFormSlice"

export default function Login() {
  const dispatch = useAppDispatch()
  const [login, { isLoading } ] = useLoginMutation()

  const email = useAppSelector(getEmail)
  const password = useAppSelector(getPassword)

  const handleLoginClick = () => login({ email, password })
    .then(({data}) => dispatch(setToken(data as string)))

  return (
    <form>
      <input placeholder="email" 
        defaultValue={email}
        onChange={e => dispatch(setEmail(e.target.value))} 
      />
      <input placeholder="password" 
        defaultValue={password}
        type="password" 
        onChange={e => dispatch(setPassword(e.target.value))} 
      />
      {!isLoading && <button onClick={handleLoginClick}>Login</button>}
    </form>
  )
}
