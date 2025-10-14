import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import CallAction from '../../src/components/CallAction'


describe('CallAction.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><CallAction /></Provider>)
  })
})