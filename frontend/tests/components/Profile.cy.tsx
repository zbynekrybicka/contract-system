import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Profile from '../../src/components/Profile'


describe('Profile.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Profile /></Provider>)
  })
})